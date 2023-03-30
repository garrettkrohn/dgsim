import React from 'react';
import { userResource } from '../../services/DTOs';
import { useAuth0 } from '@auth0/auth0-react';

const UserIcon = (props: { user: userResource }) => {
  const { user } = useAuth0();
  return (
    <div>
      <div
        className={`flex h-12 w-12 items-center justify-center rounded-full bg-[#${props.user.mainColorHex}]`}
      >
        <div className="text-black">GK</div>
      </div>
    </div>
  );
};

export default UserIcon;
