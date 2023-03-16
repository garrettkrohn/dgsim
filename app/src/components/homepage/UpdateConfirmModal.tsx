import React, { useEffect } from 'react';
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
import { useMutation, useQuery } from '@tanstack/react-query';
import { createTournament } from '../../services/tournamentsApi';
import { getPlayerByAuth, updatePlayer } from '../../services/PlayerApi';
import { useAuth0 } from '@auth0/auth0-react';

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

  const { user } = useAuth0();
  const {
    isLoading: playerIsLoading,
    error: playerError,
    data: playerData,
  } = useQuery({
    queryKey: [`player`],
    //@ts-ignore
    queryFn: () => getPlayerByAuth({ Auth0: user.sub }),
  });

  const updatePlayerCall: any = useMutation({
    mutationFn: () =>
      updatePlayer({
        firstName: playerData ? playerData.firstName : '',
        lastName: playerData ? playerData.lastName : '',
        puttSkill: putt,
        throwPowerSkill: throwPower,
        throwAccuracySkill: throwAccuracy,
        scrambleSkill: scramble,
        startSeason: playerData ? playerData.startSeason : 0,
        bankedSkillPoints: availableSp,
        archetypeId: playerData ? playerData.archetype.archetype_id : 0,
        playerId: playerData ? playerData?.playerId : 0,
        //@ts-ignore
        auth0: user ? user.sub : 'error',
      }),
    onMutate: () => console.log('mutate'),
    onError: (err, variables, context) => {
      console.log(err, variables, context);
    },
    onSettled: () => console.log('complete'),
  });

  if (playerData) {
    return (
      <div
        className="fixed top-0 h-screen w-screen text-dgsoftwhite backdrop-blur-sm"
        onClick={() => props.toggleModal()}
      >
        <div className="fixed top-1/4 left-1/2 flex h-96 w-80 -translate-x-1/2 flex-col justify-center bg-dgsecondary">
          <div className="pt-4 text-center text-2xl">Update Confirmation</div>
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
          <div className="flex justify-center">
            <Button
              label={'Submit Player Update'}
              onClick={() => {
                updatePlayerCall.mutate();
              }}
              disable={false}
            />
          </div>
        </div>
      </div>
    );
  }
};

export default UpdateConfirmModal;
