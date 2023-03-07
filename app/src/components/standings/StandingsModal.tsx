import React from 'react';

const StandingsModal = (props: { toggleModal: Function }) => {
  const seasons = [1, 2, 3];

  return (
    <div
      className="fixed top-0 left-0 h-screen w-screen text-dgsoftwhite backdrop-blur-sm"
      onClick={() => props.toggleModal()}
    >
      <div className="w-80 bg-dgsecondary ">
        {seasons.map((season, index) => (
          <div className="hover: flex h-12 cursor-pointer items-center justify-center bg-dgbackground text-dgsoftwhite">
            Season: {season}
          </div>
        ))}
      </div>
    </div>
  );
};

export default StandingsModal;
