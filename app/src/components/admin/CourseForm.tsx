import React from 'react';

const CourseForm = (props: { courseName: string }) => {
  return (
    <div className="text-dgsoftwhite">
      <div>Selected Course: {props.courseName}</div>
      <div>Tournament Name:</div>
      <div>Season Number:</div>
      <div>Number of Rounds:</div>
    </div>
  );
};

export default CourseForm;
