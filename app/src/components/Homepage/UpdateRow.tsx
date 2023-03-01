import React from 'react';
import UpdateInput from './UpdateInput';

const UpdateRow = (props: { skill: string; cost: number }) => {
  return (
    <div className="flex flex-row flex-wrap justify-between py-2">
      <div className="self-center">{props.skill}:</div>
      <UpdateInput />
      <div className="self-center">{props.cost}</div>
    </div>
  );
};

export default UpdateRow;
