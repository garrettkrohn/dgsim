import React from 'react';
import { userResource } from '../../services/DTOs';

const MyComponent = (props: { user: userResource }) => {
  return (
    <div>
      <div className="flex h-16 w-16 items-center justify-center rounded-full bg-dgsoftwhite">
        <div className="text-black">Test</div>
      </div>
    </div>
  );
};

export default MyComponent;
