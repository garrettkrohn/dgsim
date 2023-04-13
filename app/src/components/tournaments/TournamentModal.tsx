import React from 'react';
import ThinDivider from '../../util/ThinDivider';
import { tournamentResource } from '../../services/DTOs';
import Error from '../../util/Error';

/**Iterative reusable modal component
 * @param props
 * @constructor
 */
const TournamentModal = (props: {
  containerStyle: string;
  items: tournamentResource[] | undefined;
  toggleModal: Function;
  title?: string;
  selectItem: Function;
}) => {
  if (!props.items) {
    return <Error />;
  }

  return (
    <div
      className="fixed top-0 left-0 h-screen w-screen text-dgsoftwhite backdrop-blur-sm"
      onClick={() => props.toggleModal()}
    >
      <div className={props.containerStyle}>
        {props.title ? <div>{props.title}</div> : ''}
        {props.items.map((item, index) => (
          <div key={index} onClick={() => props.selectItem(item)}>
            <div className="hover: flex h-12 cursor-pointer items-center justify-center bg-dgbackground text-dgsoftwhite">
              Season: {item.season} {item.tournamentName}
            </div>
            <ThinDivider />
          </div>
        ))}
      </div>
    </div>
  );
};

export default TournamentModal;
