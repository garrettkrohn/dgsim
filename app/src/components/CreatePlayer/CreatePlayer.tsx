import React, { useEffect, useState } from 'react';
import useInput from '../../hooks/useInput';
import { useQuery } from '@tanstack/react-query';
import { getAllTournaments } from '../../services/tournamentsApi';
import { getArchetypes } from '../../services/PlayerApi';
import Loading from '../../util/Loading';
import Dropdown from '../../util/Dropdown';
import WrapperBlock from '../../util/WrapperBlock';
import UpdateRow from '../homepage/UpdateRow';
import Button from '../../util/Button';
import { useAtom } from 'jotai/index';
import { availableSpAtom } from '../../jotai/Atoms';

const CreatePlayer = () => {
  const [putt, setPutt] = useState(0);
  const [throwPower, setThrowPower] = useState(0);
  const [throwAccuracy, setThrowAccuracy] = useState(0);
  const [scramble, setScramble] = useState(0);
  const [currentPutt, setCurrentPutt] = useState(0);
  const [currentPower, setCurrentPower] = useState(0);
  const [currentAccuracy, setCurrentAccuracy] = useState(0);
  const [currentScramble, setCurrentScramble] = useState(0);
  const [availableSp, setAvailableSp] = useState(30);
  const [archetypeIndex, setArchetypeIndex] = useState<number>(-1);

  //get all archetypes
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
        <div>Available SP: {availableSp}</div>
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
    </div>
  );
};

export default CreatePlayer;
