import React from 'react';
import Divider from './Divider';
import UpdateRow from './UpdateRow';
import Button from '../../Util/Button';
import LastTournamentBlock from './LastTournamentBlock';

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
      <Divider color="dgbackground" />
      <div className="flex flex-col justify-evenly bg-dgprimary text-dgsoftwhite">
        <div className="flex justify-evenly">
          <div>Skill:</div>
          <div>Update:</div>
          <div>Cost:</div>
        </div>
        <UpdateRow skill="Putt" cost={1} />
        <UpdateRow skill="ThrowPwr" cost={1} />
        <UpdateRow skill="ThrowAcc" cost={1} />
        <UpdateRow skill="Scramble" cost={1} />
        <Button label="Submit Player Update" />
      </div>
      <Divider color="dgbackground" />
      <Divider color="dgbackground" />
      <LastTournamentBlock />
    </div>
  );
};

export default UpdateBlock;
