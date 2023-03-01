import React from 'react';
import { ArrowRightIcon, ArrowLeftIcon } from '@heroicons/react/20/solid';

const UpdateInput = () => {
  const arrowStyling = 'w-100 text-dgprimary';
  const arrowBoxStyling = 'h-5/6 w-5/6 rounded-lg bg-dgsoftwhite';
  return (
    <div className="col-start-2 col-end-5 m-auto grid grid-cols-3 items-center justify-items-center">
      <div className={arrowBoxStyling}>
        <ArrowLeftIcon className={arrowStyling} />
      </div>
      <input
        className="h-20 w-full rounded-lg bg-dgsecondary text-center text-dgsoftwhite"
        value="10"
      />
      <div className={arrowBoxStyling}>
        <ArrowRightIcon className={arrowStyling} />
      </div>
    </div>
  );
};

export default UpdateInput;
