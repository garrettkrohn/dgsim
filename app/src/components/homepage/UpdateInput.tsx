import React, { useEffect, useState } from 'react';
import { ArrowRightIcon, ArrowLeftIcon } from '@heroicons/react/20/solid';
import { useAtom } from 'jotai';
import { updateAvailableSpAtom } from '../../jotai/Atoms';

const UpdateInput = (props: {
  updateNumber: number;
  incrementCost: number;
  decrementCost: number;
  setSkill: Function;
  currentNumber: number;
}) => {
  const [availableSp, setAvailableSp] = useAtom(updateAvailableSpAtom);
  const [incrementDisable, setIncrementDisable] = useState(false);
  const [decrementDisable, setDecrementDisable] = useState(false);

  const checkIncrementDisable = () => {
    if (availableSp - props.incrementCost < 0 || props.updateNumber === 100) {
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
    // <div className="col-span-3 col-start-2 grid grid-cols-3 items-center justify-items-center">
    <>
      <div className="">
        <button
          disabled={decrementDisable}
          className="h-16 w-16 rounded-lg bg-dgsoftwhite disabled:bg-gray-500"
          onClick={decrement}
        >
          <ArrowLeftIcon className="text-dgprimary" />
        </button>
      </div>
      <div className="h-20 w-20 w-full items-center rounded-lg bg-dgsecondary text-center text-2xl text-dgsoftwhite">
        {props.updateNumber}
      </div>
      <div>
        <button
          disabled={incrementDisable}
          className="h-16 w-16 rounded-lg bg-dgsoftwhite disabled:bg-gray-500"
          onClick={increment}
        >
          <ArrowRightIcon className="w-100 disabled text-dgprimary disabled:bg-red-50" />
        </button>
      </div>
    </>
  );
};

export default UpdateInput;
