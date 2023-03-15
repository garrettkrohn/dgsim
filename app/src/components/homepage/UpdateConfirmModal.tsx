import React from 'react';
import { useAtom } from 'jotai/index';
import {
  updateAvailableSpAtom,
  currentPuttAtom,
  currentScrambleAtom,
  currentThrowAccuracyAtom,
  currentThrowPowerAtom,
  updatePuttAtom,
  updateScrambleAtom,
  updateThrowAccuracyAtom,
  updateThrowPowerAtom,
} from '../../jotai/Atoms';
import UpdateConfirmModalRow from './UpdateConfirmModalRow';
import Button from '../../util/Button';

const UpdateConfirmModal = (props: { toggleModal: Function }) => {
  const [putt] = useAtom(updatePuttAtom);
  const [throwPower] = useAtom(updateThrowPowerAtom);
  const [throwAccuracy] = useAtom(updateThrowAccuracyAtom);
  const [scramble] = useAtom(updateScrambleAtom);
  const [availableSp] = useAtom(updateAvailableSpAtom);
  const [currentPutt] = useAtom(currentPuttAtom);
  const [currentPower] = useAtom(currentThrowPowerAtom);
  const [currentAccuracy] = useAtom(currentThrowAccuracyAtom);
  const [currentScramble] = useAtom(currentScrambleAtom);
  return (
    <div
      className="fixed top-0 h-screen w-screen text-dgsoftwhite backdrop-blur-sm"
      onClick={() => props.toggleModal()}
    >
      <div className="fixed top-1/4 left-1/2 flex h-96 w-80 -translate-x-1/2 flex-col justify-center bg-dgsecondary">
        <div className="pt-4 text-2xl">Update Confirmation</div>
        <UpdateConfirmModalRow
          skillName={'Putt'}
          currentSkillNumber={currentPutt}
          updatedSkillNumber={putt}
        />
        <UpdateConfirmModalRow
          skillName={'Throw Power'}
          currentSkillNumber={currentPower}
          updatedSkillNumber={throwPower}
        />
        <UpdateConfirmModalRow
          skillName={'Throw Accuracy'}
          currentSkillNumber={currentAccuracy}
          updatedSkillNumber={throwAccuracy}
        />
        <UpdateConfirmModalRow
          skillName={'Scramble'}
          currentSkillNumber={currentScramble}
          updatedSkillNumber={scramble}
        />
      </div>
      <div className="fixed">
        <Button
          label={'Submit Player Update'}
          onClick={() => {}}
          disable={false}
        />
      </div>
    </div>
  );
};

export default UpdateConfirmModal;
