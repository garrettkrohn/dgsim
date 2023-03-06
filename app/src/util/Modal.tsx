import React from 'react';
import ThinDivider from './ThinDivider';

/**Iterative reusable modal component
 *
 * @param props
 * @constructor
 */
const Modal = (props: {
  containerStyle: string;
  itemStyle: string;
  items: number[] | string[];
  toggleModal: Function;
  title?: string;
  selectItem: Function;
}) => {
  return (
    <div
      className="fixed top-0 left-0 h-screen w-screen text-dgsoftwhite backdrop-blur-sm"
      onClick={() => props.toggleModal()}
    >
      <div className={props.containerStyle}>
        {props.title ? <div>{props.title}</div> : ''}
        {props.items.map(item => (
          <div key={item} onClick={() => props.selectItem(item)}>
            <div className={props.itemStyle}>{item}</div>
            <ThinDivider />
          </div>
        ))}
      </div>
    </div>
  );
};

export default Modal;
