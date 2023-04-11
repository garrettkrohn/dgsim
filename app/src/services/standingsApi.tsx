import { allSeasonStandings } from './DTOs';

export async function getSeasonLeaderboards(): Promise<allSeasonStandings[]> {
  const url = `${import.meta.env.VITE_BACK_END_URL}/api/leaderboards/season`;
  return await fetch(url, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
  })
    .then(response => response.json())
    .then((data: allSeasonStandings[]) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}
