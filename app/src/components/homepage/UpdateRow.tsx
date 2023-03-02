import React, { useEffect, useState } from 'react';
import UpdateInput from './UpdateInput';

const UpdateRow = (props: {
  skillName: string;
  skillNumber: number;
  setSkillNumber: Function;
  currentNumber: number;
}) => {
  const [incrementCost, setIncrementCost] = useState(1);
  const [decrementCost, setDecrementCost] = useState(1);

  const setCorrectCost = () => {
    if (props.skillNumber < 50) {
      setIncrementCost(1);
      setDecrementCost(1);
    } else if (props.skillNumber === 50) {
      setIncrementCost(2);
      setDecrementCost(1);
    } else if (props.skillNumber > 50) {
      setIncrementCost(2);
      setDecrementCost(2);
    }
  };

  useEffect(() => {
    setCorrectCost();
  }, [props.skillNumber]);

  return (
    <div className="grid grid-cols-5 items-center justify-items-center gap-1 py-2">
      <div className="self-center">{props.skillName}:</div>
      <UpdateInput
        updateNumber={props.skillNumber}
        incrementCost={incrementCost}
        decrementCost={decrementCost}
        setSkill={props.setSkillNumber}
        currentNumber={props.currentNumber}
      />
      <div className="col-start-5 col-end-6 self-center">{incrementCost}</div>
    </div>
  );
};

export default UpdateRow;
