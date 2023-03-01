import React from 'react';
import UpdateInput from './UpdateInput';

const UpdateRow = (props: { skill: string; cost: number }) => {
  return (
    <div className="grid grid-cols-5 justify-items-center py-2">
      <div className="self-center">{props.skill}:</div>
      <UpdateInput />
      <div className="col-start-5 col-end-6 self-center">{props.cost}</div>
    </div>
  );
};

export default UpdateRow;
