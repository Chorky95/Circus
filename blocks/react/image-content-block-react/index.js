/**
 * WordPress dependencies
 */
import { registerBlockType } from "@wordpress/blocks";

/**
 * Internal dependencies
 */
import Edit from "./edit";

/**
 * Register: Image Content Block (React)
 */
registerBlockType("circus/image-content-block-react", {
  edit: Edit,
});
