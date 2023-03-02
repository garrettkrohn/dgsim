import React from 'react';

const Button = (props: { label: string; onClick: Function }) => {
  // @ts-ignore
  return (
    <div className="flex justify-center">
      <button
        className="rounded-md bg-dgtertiary py-2 px-5 text-dgsoftwhite"
        onClick={props.onClick}
      >
        {props.label}
      </button>
    </div>
  );
};

export default Button;
