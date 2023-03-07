import React from 'react';
import ThinDivider from './ThinDivider';
import { tournamentResource } from '../services/DTOs';

/**Iterative reusable modal component
 *
 * @param props
 * @constructor
 */
const Modal = (props: {
  containerStyle: string;
  itemStyle: string;
  items: tournamentResource[] | undefined;
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
        {props.items.map((item, index) => (
          <div key={index} onClick={() => props.selectItem(item)}>
            <div className={props.itemStyle}>
              Season: {item.season} {item.tournamentName}
            </div>
            <ThinDivider />
          </div>
        ))}
      </div>
    </div>
  );
};

export default Modal;
