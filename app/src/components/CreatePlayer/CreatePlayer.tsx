import React, { useEffect, useState } from 'react';
import useInput from '../../hooks/useInput';
import { useMutation, useQuery } from '@tanstack/react-query';
import {
  createTournament,
  getAllTournaments,
} from '../../services/tournamentsApi';
import { createPlayer, getArchetypes } from '../../services/PlayerApi';
import Loading from '../../util/Loading';
import Dropdown from '../../util/Dropdown';
import WrapperBlock from '../../util/WrapperBlock';
import UpdateRow from '../homepage/UpdateRow';
import Button from '../../util/Button';
import { useAtom } from 'jotai/index';
import { availableSpAtom, createPlayerAvilableSp } from '../../jotai/Atoms';
import { Link, useNavigate, useRoute } from '@tanstack/react-router';

function CreatePlayer() {
  const [putt, setPutt] = useState(0);
  const [throwPower, setThrowPower] = useState(0);
  const [throwAccuracy, setThrowAccuracy] = useState(0);
  const [scramble, setScramble] = useState(0);
  const [currentPutt, setCurrentPutt] = useState(0);
  const [currentPower, setCurrentPower] = useState(0);
  const [currentAccuracy, setCurrentAccuracy] = useState(0);
  const [currentScramble, setCurrentScramble] = useState(0);
  const [createPlayerAvilableSp, setCreatePlayerAvilableSp] =
    useAtom(availableSpAtom);
  const [archetypeIndex, setArchetypeIndex] = useState<number>(-1);
  const [playerCreating, setPlayerCreating] = useState(false);
  const [disableButton, setDisableButton] = useState(true);

  const {
    isLoading: archetypesAreLoading,
    error: archetypesError,
    data: archetypesData,
    refetch,
  } = useQuery({
    queryKey: [`archetypes`],
    queryFn: () => getArchetypes(),
    enabled: false,
  });

  useEffect(() => {
    refetch();
  }, []);

  const {
    value: playerFirstName,
    valueChangeHandler: setPlayerFirstName,
    inputBlurHandler: playerFirstNameBlur,
    hasError: playerFirstNameError,
    isValid: playerFirstNameIsValid,
    reset: playerFirstNameReset,
  } = useInput((value: string) => value.trim() !== '');

  const {
    value: playerLastName,
    valueChangeHandler: setPlayerLastName,
    inputBlurHandler: playerLastNameBlur,
    hasError: playerLastNameError,
    isValid: playerLastNameIsValid,
    reset: playerLastNameReset,
  } = useInput((value: string) => value.trim() !== '');

  const items = archetypesData?.map(item => {
    return item.name;
  });

  useEffect(() => {
    if (
      playerFirstNameIsValid &&
      playerLastNameIsValid &&
      archetypeIndex !== -1
    ) {
      setDisableButton(false);
    }
  }, [playerFirstNameIsValid, playerLastNameIsValid, archetypeIndex]);

  useEffect(() => {
    setCreatePlayerAvilableSp(
      50 -
        putt +
        currentPutt -
        throwPower +
        currentPower -
        throwAccuracy +
        currentAccuracy -
        scramble +
        currentScramble,
    );
  }, [putt, throwPower, throwAccuracy, scramble]);

  useEffect(() => {
    setArchMin();
  }, [archetypeIndex]);

  const setArchMin = () => {
    if (archetypesData) {
      const selectedArchetype = archetypesData[archetypeIndex];
      setPutt(selectedArchetype.minPuttSkill);
      setCurrentPutt(selectedArchetype.minPuttSkill);
      setThrowPower(selectedArchetype.minThrowPowerSkill);
      setCurrentPower(selectedArchetype.minThrowPowerSkill);
      setThrowAccuracy(selectedArchetype.minThrowAccuracySkill);
      setCurrentAccuracy(selectedArchetype.minThrowAccuracySkill);
      setScramble(selectedArchetype.minScrambleSkill);
      setCurrentScramble(selectedArchetype.minScrambleSkill);
    }
  };

  const navigate = useNavigate();

  const createPlayerMutator: any = useMutation({
    mutationFn: () =>
      createPlayer({
        firstName: playerFirstName,
        lastName: playerLastName,
        puttSkill: putt,
        throwPowerSkill: throwPower,
        throwAccuracySkill: throwAccuracy,
        scrambleSkill: scramble,
        startSeason: 1,
        archetypeId: archetypeIndex + 1,
        bankedSkillPoints: createPlayerAvilableSp,
        userId: 1,
      }),
    onMutate: () => setPlayerCreating(true),
    onError: (err, variables, context) => {
      console.log(err, variables, context);
    },
    onSettled: () => {
      setPlayerCreating(false);
      navigate({ to: '/' });
    },
  });

  if (playerCreating) {
    return (
      <div>
        <div className="text-center text-2xl text-dgsoftwhite">
          Creating Player...
        </div>
        <Loading />
      </div>
    );
  }

  return (
    <div className="text-dgsoftwhite">
      <WrapperBlock color="dgprimary">
        <div>Create a Player</div>
      </WrapperBlock>
      <form>
        <div className="flex justify-between py-1">
          <label>Player First Name</label>
          <input
            type="text"
            id="name"
            value={playerFirstName}
            className="rounded px-3 text-black"
            onChange={setPlayerFirstName}
          />
        </div>
        <div className="flex justify-between py-1">
          <label>Player Last Name</label>
          <input
            type="text"
            id="name"
            value={playerLastName}
            className="rounded px-3 text-black"
            onChange={setPlayerLastName}
          />
        </div>

        {archetypesAreLoading ? <Loading /> : ''}
        {archetypesError ? <div>error</div> : ''}
        {archetypesData ? (
          <div>
            <Dropdown
              items={items}
              setIndex={setArchetypeIndex}
              title={'Select Archetype'}
            />
          </div>
        ) : (
          ''
        )}
      </form>
      {archetypesData && archetypeIndex !== -1 ? (
        <div>
          <div className="text-center">
            Archetype: {archetypesData[archetypeIndex].name}
          </div>
          <div className="grid grid-cols-2 border-2">
            <div> MaxPutt: {archetypesData[archetypeIndex].maxPuttSkill}</div>
            <div>
              MaxPower: {archetypesData[archetypeIndex].maxThrowPowerSkill}
            </div>
            <div>
              {' '}
              MaxAccuracy:{' '}
              {archetypesData[archetypeIndex].maxThrowAccuracySkill}
            </div>
            <div>
              {' '}
              MaxScramble: {archetypesData[archetypeIndex].maxScrambleSkill}
            </div>
          </div>
        </div>
      ) : (
        <div>Please select an Archtype</div>
      )}
      <div>
        <div className="text-center text-xl">
          Available SP: {createPlayerAvilableSp}
        </div>
        <WrapperBlock color="dgprimary">
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
        </WrapperBlock>
      </div>
      <Button
        label="Submit Player"
        onClick={createPlayerMutator.mutate}
        disable={disableButton}
      />
    </div>
  );
}

export default CreatePlayer;
