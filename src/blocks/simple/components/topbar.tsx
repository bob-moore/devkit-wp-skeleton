import { Button, Dashicon } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

import style from '../block.module.scss';

export function TopBar( props: {
	mode: string;
	setMode: Function;
	title: string;
} ) {
	const { mode, setMode, title } = props;

	return (
		<div className={ style.topbar }>
			<p>
				<Dashicon icon="editor-code" />
				{ title }
			</p>
			{ mode === 'edit' ? (
				<Button
					variant="secondary"
					text={ 'Preview' }
					onClick={ () => setMode( 'preview' ) }
				/>
			) : (
				<Button
					variant="secondary"
					text={ 'Edit' }
					onClick={ () => setMode( 'edit' ) }
				/>
			) }
		</div>
	);
}
