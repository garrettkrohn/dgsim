import React from 'react';

const Divider = (props: { color: string }) => {
  // const style = `container h-2 bg-${props.color}`;
  //this keeps breaking so I'm hard coding the color for now.

  return <div className="container h-2 bg-dgbackground" />;
};

export default Divider;
