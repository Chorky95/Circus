/**
 * WordPress dependencies
 */
import { __ } from "@wordpress/i18n";
import { InspectorControls, RichText } from "@wordpress/block-editor";
import { PanelBody, TextControl } from "@wordpress/components";

/**
 * Edit component for Give Me Jokes (React)
 */
export default function Edit({ attributes, setAttributes, className }) {
  const { title, text, getJokesButtonLabel, loadMoreButtonLabel } = attributes;

  return (
    <>
      <InspectorControls>
        <PanelBody title={__("Button Settings", "circus")} initialOpen={true}>
          <TextControl
            label={__("Get Jokes Button Label", "circus")}
            value={getJokesButtonLabel}
            onChange={(value) => setAttributes({ getJokesButtonLabel: value })}
            placeholder={__("Get Jokes", "circus")}
          />
          <TextControl
            label={__("Load More Button Label", "circus")}
            value={loadMoreButtonLabel}
            onChange={(value) => setAttributes({ loadMoreButtonLabel: value })}
            placeholder={__("Load More", "circus")}
          />
        </PanelBody>
      </InspectorControls>

      <div className="give-me-jokes" style={{ margin: "0 auto" }}>
        <div className="give-me-jokes__initial">
          <RichText
            tagName="h2"
            className="give-me-jokes__title heading-2"
            value={title}
            onChange={(value) => setAttributes({ title: value })}
            placeholder={__("Enter title...", "circus")}
          />

          <RichText
            tagName="p"
            className="give-me-jokes__text body-2"
            value={text}
            onChange={(value) => setAttributes({ text: value })}
            placeholder={__("Enter description...", "circus")}
          />

          {getJokesButtonLabel && (
            <button className="give-me-jokes__button button">
              {getJokesButtonLabel}
            </button>
          )}
        </div>

        <div
          style={{
            marginTop: "20px",
            padding: "15px",
            background: "#f0f0f0",
            borderRadius: "4px",
          }}
        >
          <p style={{ margin: 0, fontSize: "12px", color: "#666" }}>
            <strong>{__("Editor Note:", "circus")}</strong>{" "}
            {__(
              "Jokes will be fetched dynamically on the frontend when the button is clicked.",
              "circus",
            )}
          </p>
        </div>
      </div>
    </>
  );
}
