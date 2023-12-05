import { useState } from '@wordpress/element';
import { ResizableBox } from '@wordpress/components';
import MonacoEditor from 'react-monaco-editor';
import styles from '../block.module.scss';

type Props = {
	height: number;
	value: string;
	onChange: Function;
	theme: string;
};

const enabled = {
	top: false,
	right: false,
	left: false,
	topRight: false,
	bottomRight: false,
	bottomLeft: false,
	topLeft: false,
	bottom: true,
};

export function Editor( props: Props ) {
	const [ height, setHeight ] = useState( props.height );

	const onResize = (
		event: MouseEvent | TouchEvent,
		direction: string,
		elt: HTMLDivElement,
		delta: any
	): void => {
		setHeight( height + delta.height );
	};

	return (
		<ResizableBox
			size={ {
				height,
				width: '100%',
			} }
			minHeight="50"
			enable={ enabled }
			onResizeStop={ onResize }
		>
			<MonacoEditor
				height="100%"
				language={ 'html' }
				value={ props.value }
				onChange={ ( value ) => props.onChange( value ) }
				options={ {
					minimap: {
						enabled: false,
					},
					fontSize: 14,
					automaticLayout: true,
					scrollBeyondLastLine: false,
					selectionHighlight: false,
					renderLineHighlight: 'none',
					cursorStyle: 'line',
					cursorBlinking: 'solid',
					folding: false,
					lineDecorationsWidth: 32,
					scrollbar: {
						useShadows: false,
					},
				} }
			/>
		</ResizableBox>
	);
}
