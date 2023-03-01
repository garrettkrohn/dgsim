import React from 'react';

const Divider = (props: { color: string }) => {
  const style = `h-2 container bg-${props.color}`;
  return <div className={style} />;
};

export default Divider;
