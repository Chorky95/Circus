/**
 * WordPress dependencies
 */
import { __ } from "@wordpress/i18n";
import {
  InspectorControls,
  MediaUpload,
  MediaUploadCheck,
  RichText,
} from "@wordpress/block-editor";
import {
  PanelBody,
  Button,
  TextControl,
  ToggleControl,
} from "@wordpress/components";

/**
 * Edit component for Image Content Block (React)
 */
export default function Edit({ attributes, setAttributes, className }) {
  const {
    title,
    text,
    linkUrl,
    linkText,
    linkTarget,
    imageUrl,
    imageAlt,
    imageId,
  } = attributes;

  const onSelectImage = (media) => {
    setAttributes({
      imageUrl: media.url,
      imageAlt: media.alt,
      imageId: media.id,
    });
  };

  const onRemoveImage = () => {
    setAttributes({
      imageUrl: "",
      imageAlt: "",
      imageId: 0,
    });
  };

  return (
    <>
      <InspectorControls>
        <PanelBody title={__("Link Settings", "circus")} initialOpen={true}>
          <TextControl
            label={__("Link URL", "circus")}
            value={linkUrl}
            onChange={(value) => setAttributes({ linkUrl: value })}
            placeholder="https://"
          />
          <TextControl
            label={__("Link Text", "circus")}
            value={linkText}
            onChange={(value) => setAttributes({ linkText: value })}
            placeholder={__("Explore", "circus")}
          />
          <ToggleControl
            label={__("Open in new tab", "circus")}
            checked={linkTarget === "_blank"}
            onChange={(value) =>
              setAttributes({ linkTarget: value ? "_blank" : "" })
            }
          />
        </PanelBody>
      </InspectorControls>

      <div className="image-content-block">
        <div className="image-content-block__container container">
          <div className="image-content-block__content">
            <RichText
              tagName="h2"
              className="image-content-block__title heading-2"
              value={title}
              onChange={(value) => setAttributes({ title: value })}
              placeholder={__("Enter title...", "circus")}
            />

            <RichText
              tagName="p"
              className="image-content-block__text body-2"
              value={text}
              onChange={(value) => setAttributes({ text: value })}
              placeholder={__("Enter content text...", "circus")}
            />

            {linkText && linkUrl && (
              <div className="image-content-block__link button">{linkText}</div>
            )}
          </div>

          <div className="image-content-block__image">
            <MediaUploadCheck>
              <MediaUpload
                onSelect={onSelectImage}
                allowedTypes={["image"]}
                value={imageId}
                render={({ open }) => (
                  <div>
                    {imageUrl ? (
                      <div>
                        <img src={imageUrl} alt={imageAlt || title} />
                        <Button
                          onClick={onRemoveImage}
                          isDestructive
                          style={{ marginTop: "10px" }}
                        >
                          {__("Remove Image", "circus")}
                        </Button>
                      </div>
                    ) : (
                      <Button onClick={open} isPrimary>
                        {__("Select Image", "circus")}
                      </Button>
                    )}
                  </div>
                )}
              />
            </MediaUploadCheck>
          </div>
        </div>
      </div>
    </>
  );
}
