import { registerBlockType } from '@wordpress/blocks';
import {
	Fragment,
	useState,
	useEffect,
	renderToString,
} from '@wordpress/element';
import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	InnerBlocks,
	useInnerBlocksProps,
} from '@wordpress/block-editor';

import { TopBar } from './components/topbar';
import { Toolbar } from './components/toolbar';
import { Sidebar } from './components/sidebar';
import { Editor } from './components/monaco-editor';

import parse from 'html-react-parser';

import style from './block.module.scss';

import metadata from './block.json';

type Attributes = {
	value: string;
	title: string;
};

type Props = {
	attributes: Attributes;
	setAttributes: Function;
	clientId: string;
	toggleSelection: Function;
};

function Edit( { attributes, setAttributes }: Props ) {
	const blockProps = useBlockProps();
	const { children, ...innerBlocksProps } = useInnerBlocksProps();
	const [ mode, setMode ] = useState( 'preview' );
	const [ theme, setTheme ] = useState(
		localStorage.getItem( 'mwf-custom-markup/theme' ) || 'light'
	);

	useEffect(
		() => localStorage.setItem( 'mwf-custom-markup/theme', theme ),
		[ theme ]
	);

	const markupWithInnerBlocks = () => {
		const markup = attributes.value.replace(
			'{{innerBlocks}}',
			'<div id="innerblocks">'
		);

		return parse( markup, {
			replace: ( domNode ) => {
				if ( domNode.attribs && domNode.attribs.id === 'innerblocks' ) {
					return <div { ...innerBlocksProps }>{ children }</div>;
				}
			},
		} );
	};

	return (
		<div { ...blockProps }>
			<Sidebar
				title={ attributes.title }
				setTitle={ ( title: string ) => setAttributes( { title } ) }
				theme={ theme }
				setTheme={ ( newTheme: string ) => setTheme( newTheme ) }
			/>

			<Toolbar mode={ mode } setMode={ setMode } />

			<div className={ style.editorEmbed }>
				<TopBar
					mode={ mode }
					setMode={ setMode }
					title={ attributes.title }
				/>
			</div>
		</div>
	);
}

registerBlockType( metadata, {
	edit: Edit,
	save: null,
} );
