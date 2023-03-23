import React, { PropsWithChildren } from 'react';

const ButtonWrapper = (props: PropsWithChildren): JSX.Element => {
  return (
    <div className="flex justify-center py-1">
      <div className="rounded-md bg-dgtertiary py-2 px-5 text-dgsoftwhite disabled:bg-opacity-10 disabled:text-opacity-10">
        {props.children}
      </div>
    </div>
  );
};

export default ButtonWrapper;
