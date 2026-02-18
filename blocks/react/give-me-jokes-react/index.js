/**
 * WordPress dependencies
 */
import { registerBlockType } from "@wordpress/blocks";

/**
 * Internal dependencies
 */
import Edit from "./edit";

/**
 * Register: Give Me Jokes (React)
 */
registerBlockType("circus/give-me-jokes-react", {
  edit: Edit,
  save: () => null, // Rendered via PHP
});
