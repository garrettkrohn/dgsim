import React, { useEffect, useState } from 'react';
import { ArrowRightIcon, ArrowLeftIcon } from '@heroicons/react/20/solid';
import { useAtom } from 'jotai';
import { availableSpAtom } from '../../jotai/Atoms';

const UpdateInput = (props: {
  updateNumber: number;
  incrementCost: number;
  decrementCost: number;
  setSkill: Function;
  currentNumber: number;
}) => {
  const [availableSp, setAvailableSp] = useAtom(availableSpAtom);
  const [incrementDisable, setIncrementDisable] = useState(false);
  const [decrementDisable, setDecrementDisable] = useState(false);

  const checkIncrementDisable = () => {
    if (availableSp - props.incrementCost < 0) {
      setIncrementDisable(true);
    } else {
      setIncrementDisable(false);
    }
  };

  const checkDecrementDisable = () => {
    if (props.updateNumber - props.decrementCost < props.currentNumber) {
      setDecrementDisable(true);
    } else {
      setDecrementDisable(false);
    }
  };

  useEffect(() => {
    checkIncrementDisable();
    checkDecrementDisable();
  }, [availableSp, props.updateNumber, props.incrementCost]);

  const increment = () => {
    props.setSkill(props.updateNumber + 1);
    setAvailableSp(availableSp - props.incrementCost);
  };

  const decrement = () => {
    props.setSkill(props.updateNumber - 1);
    setAvailableSp(availableSp + props.decrementCost);
  };

  return (
    <div className="col-start-2 col-end-5 m-auto grid grid-cols-3 items-center justify-items-center">
      <button
        disabled={decrementDisable}
        className="h-5/6 w-5/6 rounded-lg bg-dgsoftwhite"
        onClick={decrement}
      >
        <ArrowLeftIcon className="w-100 text-dgprimary" />
      </button>
      <input
        className="h-20 w-full rounded-lg bg-dgsecondary text-center text-dgsoftwhite"
        value={props.updateNumber}
      />
      <button
        disabled={incrementDisable}
        className="h-5/6 w-5/6 rounded-lg bg-dgsoftwhite"
        onClick={increment}
      >
        <ArrowRightIcon className="w-100 disabled text-dgprimary disabled:bg-red-50" />
      </button>
    </div>
  );
};

export default UpdateInput;
