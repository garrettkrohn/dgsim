import React from 'react';
import Divider from './Divider';

const UpdateBlock = () => {
  return (
    <div>
      <div className="bg-dgprimary text-dgsoftwhite">
        <div className="container flex justify-center p-2 font-bold">
          Update Player
        </div>
        <div className="container flex flex-row justify-evenly p-1">
          <div>Bank: 10</div>
          <div>NewSp: 10</div>
          <div>Total: 10</div>
        </div>
      </div>
      <Divider />
      <div className="flex justify-evenly bg-dgprimary text-dgsoftwhite">
        <div>
          <div>Skill:</div>
          <div>Putt:</div>
          <div>Throw Pwr:</div>
          <div>Throw Acc:</div>
          <div>Scramble:</div>
        </div>
        <div></div>
        <div>
          <div>Cost:</div>
        </div>
      </div>
    </div>
  );
};

export default UpdateBlock;
