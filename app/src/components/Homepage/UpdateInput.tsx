import React from 'react';
import { ArrowRightIcon, ArrowLeftIcon } from '@heroicons/react/20/solid';

const UpdateInput = () => {
  const arrowStyling = 'w-100 text-dgprimary';
  const arrowBoxStyling = 'h-20 w-20 rounded-md bg-dgsoftwhite';
  return (
    <div className="m-auto flex flex-row">
      <div className={arrowBoxStyling}>
        <ArrowLeftIcon className={arrowStyling} />
      </div>
      <input className="h-20 w-8 text-dgblack" value="10" />
      <div className={arrowBoxStyling}>
        <ArrowRightIcon className={arrowStyling} />
      </div>
    </div>
  );
};

export default UpdateInput;
