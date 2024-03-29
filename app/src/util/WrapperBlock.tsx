import React, { useEffect } from 'react';

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

  const style = `p-2 text-dgsoftwhite bg-${color}`;

  return (
    <div
      className={style}
      onClick={handleClick}
      style={{ backgroundColor: color }}
    >
      <div>{children}</div>
    </div>
  );
};

export default WrapperBlock;
