import { useState } from '@wordpress/element';
import { ResizableBox } from '@wordpress/components';

type Props = {
	height: number;
	value: string;
	onChange: Function;
	theme: string;
};

export function Editor( props: Props ) {
	const [ height, setHeight ] = useState( props.height );

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
		></ResizableBox>
	);
}
