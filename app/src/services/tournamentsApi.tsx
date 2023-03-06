import { TournamentResource } from './DTOs';

export async function getTournament(
  tournamentId: number,
): Promise<TournamentResource> {
  return await fetch(`http://localhost:8000/api/tournaments/${tournamentId}`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
  })
    .then(response => response.json())
    .then((data: TournamentResource) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}

export async function getSeasons(): Promise<number[]> {
  return await fetch(`http://localhost:8000/api/seasons`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
  })
    .then(response => response.json())
    .then((data: number[]) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}

export async function getTournamentBySeason(
  seasonNumber: number,
): Promise<TournamentResource[]> {
  return await fetch(
    `http://localhost:8000/api/tournaments/seasons/${seasonNumber}`,
    {
      headers: {
        'Content-Type': 'application/json',
      },
      method: 'GET',
    },
  )
    .then(response => response.json())
    .then((data: TournamentResource[]) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}
