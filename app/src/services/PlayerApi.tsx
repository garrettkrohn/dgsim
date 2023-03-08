import { playerResource } from './DTOs';

export async function getPlayer(playerId: number): Promise<playerResource> {
  return await fetch(`http://localhost:8000/api/players/${playerId}`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
  })
    .then(response => response.json())
    .then((data: playerResource) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}
