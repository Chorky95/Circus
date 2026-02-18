/**
 * WordPress dependencies
 */
import { registerBlockType } from "@wordpress/blocks";

/**
 * Internal dependencies
 */
import Edit from "./edit";

/**
 * Register: Hero Block (React)
 */
registerBlockType("circus/hero-block-react", {
  edit: Edit,
  save: () => null, // Rendered via PHP
});
