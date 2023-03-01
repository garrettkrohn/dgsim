import React, { useEffect, useState } from 'react';
import { ArrowRightIcon, ArrowLeftIcon } from '@heroicons/react/20/solid';
import { useAtom } from 'jotai';
import { availableSpAtom } from '../../jotai/Atoms';

const UpdateInput = (props: {
  currentNumber: number;
  incrementCost: number;
  decrementCost: number;
  setSkill: Function;
}) => {
  const [availableSp, setAvailableSp] = useAtom(availableSpAtom);
  const [disable, setDisable] = useState(false);

  useEffect(() => {
    console.log(`total: ${availableSp}`);
    console.log(props.incrementCost);
    if (availableSp - props.incrementCost < 0) {
      setDisable(true);
    } else {
      setDisable(false);
    }
  }, [availableSp, props.currentNumber, props.incrementCost]);

  const increment = () => {
    props.setSkill(props.currentNumber + 1);
    setAvailableSp(availableSp - props.incrementCost);
  };

  const decrement = () => {
    props.setSkill(props.currentNumber - 1);
    setAvailableSp(availableSp + props.decrementCost);
  };

  return (
    <div className="col-start-2 col-end-5 m-auto grid grid-cols-3 items-center justify-items-center">
      <div className="h-5/6 w-5/6 rounded-lg bg-dgsoftwhite">
        <ArrowLeftIcon className="w-100 text-dgprimary" onClick={decrement} />
      </div>
      <input
        className="h-20 w-full rounded-lg bg-dgsecondary text-center text-dgsoftwhite"
        value={props.currentNumber}
      />
      <button
        disabled={disable}
        className="h-5/6 w-5/6 rounded-lg bg-dgsoftwhite"
        onClick={increment}
      >
        <ArrowRightIcon className="w-100 disabled text-dgprimary disabled:bg-red-50" />
      </button>
    </div>
  );
};

export default UpdateInput;
