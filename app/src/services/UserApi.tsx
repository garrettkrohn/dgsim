import { createOrGetUserParams, userResource } from './DTOs';

export async function createOrGetUser(
  params: createOrGetUserParams,
): Promise<userResource> {
  return await fetch(`http://localhost:8000/api/users`, {
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
