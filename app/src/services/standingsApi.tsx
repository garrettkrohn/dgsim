import { seasonStandingsResource, tournamentResource } from './DTOs';

export async function getSeasonLeaderboards(
  seasonNumber: number,
): Promise<seasonStandingsResource[]> {
  return await fetch(
    `http://localhost:8000/api/leaderboards/season/${seasonNumber}`,
    {
      headers: {
        'Content-Type': 'application/json',
      },
      method: 'GET',
    },
  )
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
