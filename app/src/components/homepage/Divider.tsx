import React from 'react';

const Divider = (props: { color: string }) => {
  const style = `container h-2 bg-${props.color}`;
  return <div className={style} />;
};

export default Divider;
