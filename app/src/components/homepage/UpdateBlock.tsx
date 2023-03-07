import React, { useEffect, useState } from 'react';
import Divider from '../../util/Divider';
import UpdateRow from './UpdateRow';
import Button from '../../util/Button';
import LastTournamentBlock from './LastTournamentBlock';
import { useAtom } from 'jotai';
import {
  updatePuttAtom,
  updateThrowAccuracyAtom,
  updateThrowPowerAtom,
  updateScrambleAtom,
  availableSpAtom,
  currentPuttAtom,
  currentThrowPowerAtom,
  currentThrowAccuracyAtom,
  currentScrambleAtom,
} from '../../jotai/Atoms';

const UpdateBlock = (props: { toggleUpdateModal: Function }) => {
  const [putt, setPutt] = useAtom(updatePuttAtom);
  const [throwPower, setThrowPower] = useAtom(updateThrowPowerAtom);
  const [throwAccuracy, setThrowAccuracy] = useAtom(updateThrowAccuracyAtom);
  const [scramble, setScramble] = useAtom(updateScrambleAtom);
  const [availableSp] = useAtom(availableSpAtom);
  const [currentPutt] = useAtom(currentPuttAtom);
  const [currentPower] = useAtom(currentThrowPowerAtom);
  const [currentAccuracy] = useAtom(currentThrowAccuracyAtom);
  const [currentScramble] = useAtom(currentScrambleAtom);

  const [disableUpdate, setDisableUpdate] = useState(true);

  const [showUpdate, setShowUpdate] = useState(false);

  const toggleUpdate = () => {
    setShowUpdate(!showUpdate);
  };

  useEffect(() => {
    if (
      putt + throwPower + throwAccuracy + scramble ===
      currentPutt + currentPower + currentAccuracy + currentScramble
    ) {
      setDisableUpdate(true);
    } else {
      setDisableUpdate(false);
    }
  }, [
    putt,
    throwPower,
    throwAccuracy,
    scramble,
    currentPutt,
    currentPower,
    currentAccuracy,
    currentScramble,
  ]);

  return (
    <div>
      <div className="bg-dgprimary text-dgsoftwhite" onClick={toggleUpdate}>
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
      {showUpdate ? (
        <>
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
              currentNumber={currentPutt}
            />
            <UpdateRow
              skillName="ThrowPwr"
              skillNumber={throwPower}
              setSkillNumber={setThrowPower}
              currentNumber={currentPower}
            />
            <UpdateRow
              skillName="ThrowAcc"
              skillNumber={throwAccuracy}
              setSkillNumber={setThrowAccuracy}
              currentNumber={currentAccuracy}
            />
            <UpdateRow
              skillName="Scramble"
              skillNumber={scramble}
              setSkillNumber={setScramble}
              currentNumber={currentScramble}
            />
            <Button
              label="Submit Player Update"
              onClick={props.toggleUpdateModal}
              disable={disableUpdate}
            />
          </div>
          <Divider color="dgbackground" />
        </>
      ) : (
        ''
      )}
    </div>
  );
};

export default UpdateBlock;
