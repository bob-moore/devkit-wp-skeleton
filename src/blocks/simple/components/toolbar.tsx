import { BlockControls } from '@wordpress/block-editor';
import { ToolbarButton, ToolbarGroup } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

export function Toolbar( props: { mode: string; setMode: Function } ) {
	const { mode, setMode } = props;

	return (
		<BlockControls>
			<ToolbarGroup>
				<ToolbarButton
					className="components-tab-button"
					isPressed={ mode === 'edit' }
					onClick={ () => setMode( 'edit' ) }
				>
					{ __( 'Edit' ) }
				</ToolbarButton>
				<ToolbarButton
					className="components-tab-button"
					isPressed={ mode === 'preview' }
					onClick={ () => setMode( 'preview' ) }
				>
					{ __( 'Preview' ) }
				</ToolbarButton>
			</ToolbarGroup>
		</BlockControls>
	);
}
