import React, { useState } from 'react';
import Divider from './Divider';
import UpdateRow from './UpdateRow';
import Button from '../../util/Button';
import LastTournamentBlock from './LastTournamentBlock';
import { useAtom, useSetAtom } from 'jotai';
import {
  updatePuttAtom,
  updateThrowAccuracyAtom,
  updateThrowPowerAtom,
  updateScrambleAtom,
  availableSpAtom,
} from '../../jotai/Atoms';

const UpdateBlock = () => {
  const [putt, setPutt] = useAtom(updatePuttAtom);
  const [throwPower, setThrowPower] = useAtom(updateThrowPowerAtom);
  const [throwAccuracy, setThrowAccuracy] = useAtom(updateThrowAccuracyAtom);
  const [scramble, setScramble] = useAtom(updateScrambleAtom);
  const [availableSp] = useAtom(availableSpAtom);

  return (
    <div>
      <div className="bg-dgprimary text-dgsoftwhite">
        <div className="container flex justify-center p-2 font-bold">
          Update Player
        </div>
        <div className="container flex flex-row justify-evenly p-1">
          <div>Bank: 10</div>
          <div>NewSp: 10</div>
          <div>Total: {availableSp}</div>
        </div>
      </div>
      <Divider color="dgbackground" />
      <div className="flex flex-col justify-evenly bg-dgprimary text-dgsoftwhite">
        <div className="flex justify-evenly">
          <div>Skill:</div>
          <div>Update:</div>
          <div>Cost:</div>
        </div>
        <UpdateRow
          skillName="Putt"
          skillNumber={putt}
          setSkillNumber={setPutt}
        />
        <UpdateRow
          skillName="ThrowPwr"
          skillNumber={throwPower}
          setSkillNumber={setThrowPower}
        />
        <UpdateRow
          skillName="ThrowAcc"
          skillNumber={throwAccuracy}
          setSkillNumber={setThrowAccuracy}
        />
        <UpdateRow
          skillName="Scramble"
          skillNumber={scramble}
          setSkillNumber={setScramble}
        />
        <Button label="Submit Player Update" />
      </div>
      <Divider color="dgbackground" />
      <LastTournamentBlock />
    </div>
  );
};

export default UpdateBlock;
