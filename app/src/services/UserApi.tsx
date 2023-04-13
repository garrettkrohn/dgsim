import {
  createOrGetUserParams,
  updateAvatarColorsParams,
  updateUserColorsParams,
  userResource,
} from './DTOs';

export async function CreateOrGetUser(
  params: createOrGetUserParams,
): Promise<userResource> {
  const url = `${import.meta.env.VITE_BACK_END_URL}/api/users`;
  return await fetch(url, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'POST',
    body: JSON.stringify(params),
  })
    .then(response => response.json())
    .then((data: userResource) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}

export async function updateUserColors(
  params: updateUserColorsParams,
): Promise<userResource> {
  const url = `${import.meta.env.VITE_BACK_END_URL}/api/users/colors`;
  return await fetch(url, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'POST',
    body: JSON.stringify(params),
  })
    .then(response => response.json())
    .then((data: userResource) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}

export async function updateAvatarColors(
  params: updateAvatarColorsParams,
): Promise<userResource> {
  const url = `${import.meta.env.VITE_BACK_END_URL}/api/users/avatarColors`;
  return await fetch(url, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'POST',
    body: JSON.stringify(params),
  })
    .then(response => response.json())
    .then((data: userResource) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}
