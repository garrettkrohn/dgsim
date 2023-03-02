import React from 'react';
import { ArrowSmallRightIcon } from '@heroicons/react/20/solid';

const UpdateConfirmModalRow = (props: {
  skillName: string;
  currentSkillNumber: number;
  updatedSkillNumber: number;
}) => {
  return (
    <div className="flex-rows flex justify-between p-3">
      <div>{props.skillName}:</div>
      <div>{props.currentSkillNumber}</div>
      <ArrowSmallRightIcon className="h-6" />
      <div>{props.updatedSkillNumber}</div>
      <div> increase of: </div>
      <div>{props.updatedSkillNumber - props.currentSkillNumber}</div>
    </div>
  );
};

export default UpdateConfirmModalRow;
