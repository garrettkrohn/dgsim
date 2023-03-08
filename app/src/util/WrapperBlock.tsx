import React from 'react';

interface Props {
  children: JSX.Element;
  color: string;
}

const WrapperBlock: React.FC<Props> = ({ children, color }) => {
  const style = 'container p-2 text-dgsoftwhite bg-' + color;
  return (
    <div className={style}>
      <div>{children}</div>
    </div>
  );
};

export default WrapperBlock;
