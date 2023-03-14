import React, { useEffect, useState } from 'react';
import useInput from '../../hooks/useInput';
import { useQuery } from '@tanstack/react-query';
import { getAllTournaments } from '../../services/tournamentsApi';
import { getArchetypes } from '../../services/PlayerApi';
import Loading from '../../util/Loading';
import Dropdown from '../../util/Dropdown';
import WrapperBlock from '../../util/WrapperBlock';

const CreatePlayer = () => {
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

  const [archetypeIndex, setArchetypeIndex] = useState<number>(0);

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
        {archetypesAreLoading ? <Loading /> : ''}
        {archetypesError ? <div>error</div> : ''}
      </form>
      {archetypesData ? (
        <div>archetype: {archetypesData[archetypeIndex].name}</div>
      ) : (
        ''
      )}
    </div>
  );
};

export default CreatePlayer;
