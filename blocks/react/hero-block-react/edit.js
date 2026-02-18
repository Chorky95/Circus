/**
 * WordPress dependencies
 */
import { __ } from "@wordpress/i18n";
import {
  MediaUpload,
  MediaUploadCheck,
  RichText,
} from "@wordpress/block-editor";
import { Button } from "@wordpress/components";

/**
 * Edit component for Hero Block (React)
 */
export default function Edit({ attributes, setAttributes, className }) {
  const { title, subtitle, backgroundImageUrl, backgroundImageId } = attributes;

  const onSelectImage = (media) => {
    setAttributes({
      backgroundImageUrl: media.url,
      backgroundImageId: media.id,
    });
  };

  const onRemoveImage = () => {
    setAttributes({
      backgroundImageUrl: "",
      backgroundImageId: 0,
    });
  };

  return (
    <div
      className="hero-block"
      style={{
        margin: "0 auto",
        position: "relative",
        minHeight: "400px",
        backgroundColor: "#000",
      }}
    >
      {backgroundImageUrl && (
        <img
          className="hero-block__background"
          src={backgroundImageUrl}
          alt=""
        />
      )}

      <div className="hero-block__content">
        <RichText
          tagName="h1"
          className="hero-block__title heading-1"
          value={title}
          onChange={(value) => setAttributes({ title: value })}
          placeholder={__("Enter hero title...", "circus")}
        />

        <RichText
          tagName="p"
          className="hero-block__subtitle body-2"
          value={subtitle}
          onChange={(value) => setAttributes({ subtitle: value })}
          placeholder={__("Enter hero subtitle...", "circus")}
        />

        <div>
          <MediaUploadCheck>
            <MediaUpload
              onSelect={onSelectImage}
              allowedTypes={["image"]}
              value={backgroundImageId}
              render={({ open }) => (
                <div>
                  {backgroundImageUrl ? (
                    <Button onClick={onRemoveImage} isDestructive>
                      {__("Remove Background Image", "circus")}
                    </Button>
                  ) : (
                    <Button
                      onClick={open}
                      style={{ backgroundColor: "blue", color: "#fff" }}
                    >
                      {__("Select Background Image", "circus")}
                    </Button>
                  )}
                </div>
              )}
            />
          </MediaUploadCheck>
        </div>
      </div>
    </div>
  );
}
