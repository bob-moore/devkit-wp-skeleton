/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
 import { 
	useBlockProps, 
	RichText, 
	AlignmentControl, 
	BlockControls,
	InspectorControls,
	PanelColorSettings
} from '@wordpress/block-editor';

import {
	TextControl,
	PanelBody,
	PanelRow,
	ToggleControl,
	ExternalLink,
	__experimentalHeading as Heading
} from '@wordpress/components';
import { Image } from '@10up/block-components';
/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
// import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit( { attributes, setAttributes } ) {

	const { imageId, focalPoint, content, align, backgroundColor, textColor, kaLink, linkLabel, hasLinkNofollow } = attributes;

	const onChangeContent = ( newContent ) => {
		setAttributes( { content: newContent } )
	}

    function handleImageSelect( image ) {
        setAttributes({imageId: image.id});
    }

    function handleFocalPointChange( value ) {
        setAttributes({focalPoint: value});
    }
	const onChangeAlign = ( newAlign ) => {
		setAttributes( { 
			align: newAlign === undefined ? 'none' : newAlign, 
		} )
	}

	const blockProps = useBlockProps( {
		className: `has-text-align-${ align }`
	} );

	const onChangeBackgroundColor = ( newBackgroundColor ) => {
		setAttributes( { backgroundColor: newBackgroundColor } )
	}
	const onChangeTextColor = ( newTextColor ) => {
		setAttributes( { textColor: newTextColor } )
	}

	const onChangeKaLink = ( newKaLink ) => {
		setAttributes( { kaLink: newKaLink === undefined ? '' : newKaLink } )
	}
	
	const onChangeLinkLabel = ( newLinkLabel ) => {
		setAttributes( { linkLabel: newLinkLabel === undefined ? '' : newLinkLabel } )
	}
	
	const toggleNofollow = () => {
		setAttributes( { hasLinkNofollow: ! hasLinkNofollow } )
	}

	return (
		<div 
			{ ...blockProps }
			style={ { backgroundColor: backgroundColor } }
		>
			<InspectorControls>
				<PanelColorSettings 
					title={ __( 'Color settings', 'ka-example-block' ) }
					initialOpen={ false }
					colorSettings={ [
						{
						  value: textColor,
						  onChange: onChangeTextColor,
						  label: __( 'Text color', 'ka-example-block' )
						},
						{
						  value: backgroundColor,
						  onChange: onChangeBackgroundColor,
						  label: __( 'Background color', 'ka-example-block' )
						}
					] }
				/>
				<PanelBody 
					title={ __( 'Link Settings', 'ka-example-block' )}
					initialOpen={true}
				>
					<PanelRow>
						<fieldset>
							<TextControl
								label={__( 'KA link', 'ka-example-block' )}
								value={ kaLink }
								onChange={ onChangeKaLink }
								help={ __( 'Add your Academy link', 'ka-example-block' )}
							/>
						</fieldset>
					</PanelRow>
					<PanelRow>
						<fieldset>
							<TextControl
								label={__( 'Link label', 'ka-example-block' )}
								value={ linkLabel }
								onChange={ onChangeLinkLabel }
								help={ __( 'Add link label', 'ka-example-block' )}
							/>
						</fieldset>
					</PanelRow>
					<PanelRow>
						<fieldset>
							<ToggleControl
								label="Add rel = nofollow"
								help={
									hasLinkNofollow
										? 'Has rel nofollow.'
										: 'No rel nofollow.'
								}
								checked={ hasLinkNofollow }
								onChange={ toggleNofollow }
							/>
						</fieldset>
					</PanelRow>
				</PanelBody>
			</InspectorControls>
			<BlockControls>
				<AlignmentControl
					value={ align }
					onChange={ onChangeAlign }
				/>
			</BlockControls>
			<Image
				id={imageId}
				className="my-image"
				size="full"
				onSelect={handleImageSelect}
				focalPoint={focalPoint}
				onChangeFocalPoint={handleFocalPointChange}
				// allowedTypes={['image/gif']}
				labels={{
					title: 'Select Gif Image',
					instructions: 'Upload a GIF or pick one from your media library.'
				}}
			/>
			<RichText 
				tagName="p"
				onChange={ onChangeContent }
				allowedFormats={ [ 'core/bold', 'core/italic' ] }
				value={ content }
				placeholder={ __( 'Write your text...' ) }
				style={ { textAlign: align, color: textColor } }
			/>
			<ExternalLink 
				href={ kaLink }
				className="ka-button"
				rel={ hasLinkNofollow ? "nofollow" : "" }
			>
					{ linkLabel }
			</ExternalLink>
		</div>
	);
}