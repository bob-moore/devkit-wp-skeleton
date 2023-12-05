import { InspectorControls } from '@wordpress/block-editor';
import { SelectControl, TextControl, PanelBody } from '@wordpress/components';

type Props = {
	title: string;
	setTitle: Function;
	theme: string;
	setTheme: Function;
};

export function Sidebar( { title, setTitle, theme, setTheme }: Props ) {
	return (
		<InspectorControls>
			<PanelBody>
				<TextControl
					label="Title"
					value={ title }
					onChange={ ( value: string ) => setTitle( value ) }
				/>

				<SelectControl
					label="Theme"
					value={ theme }
					onChange={ ( value: string ) => setTheme( value ) }
					options={ [
						{
							label: 'Light',
							value: 'light',
						},
						{
							label: 'Dark',
							value: 'dark',
						},
					] }
				/>
			</PanelBody>
		</InspectorControls>
	);
}
