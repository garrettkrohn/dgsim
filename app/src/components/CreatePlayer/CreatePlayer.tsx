import React, { useState } from 'react';
import useInput from '../../hooks/useInput';

const CreatePlayer = () => {
  //get all archetypes
  const [archetypeIndex, setArchetypeIndex] = useState(0);

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

  return (
    <div className="text-dgsoftwhite">
      <div>Create a Player</div>
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
      </form>
    </div>
  );
};

export default CreatePlayer;
