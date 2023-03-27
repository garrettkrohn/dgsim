import React from 'react';

interface Props {
  children: JSX.Element | JSX.Element[];
  color: string;
  onClick?: Function;
}

const WrapperBlock: React.FC<Props> = ({ children, color, onClick }) => {
  const handleClick = () => {
    if (onClick) {
      onClick();
    }
  };

  return (
    <div className={`p-2 text-dgsoftwhite bg-${color}`} onClick={handleClick}>
      <div>{children}</div>
    </div>
  );
};

export default WrapperBlock;
