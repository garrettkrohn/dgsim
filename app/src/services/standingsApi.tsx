import { seasonStandingsResource } from './DTOs';

export async function getSeasonLeaderboards(): Promise<
  seasonStandingsResource[]
> {
  return await fetch(`http://localhost:8000/api/leaderboards/season`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
  })
    .then(response => response.json())
    .then((data: seasonStandingsResource[]) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}
