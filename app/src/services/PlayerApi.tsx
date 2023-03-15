import { archetypeResource, createPlayerParams, playerResource } from './DTOs';

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

export async function getPlayerByAuth(auth0: string): Promise<playerResource> {
  return await fetch(`http://localhost:8000/api/playersAuth`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
    body: JSON.stringify(auth0),
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

export async function getArchetypes(): Promise<archetypeResource[]> {
  return await fetch(`http://localhost:8000/api/archetypes`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'GET',
  })
    .then(response => response.json())
    .then((data: archetypeResource[]) => {
      console.log('Success:', data);
      return data;
    })
    .catch(error => {
      console.error('Error:', error);
      throw error;
    });
}

export async function createPlayer(
  params: createPlayerParams,
): Promise<playerResource> {
  return await fetch(`http://localhost:8000/api/players`, {
    headers: {
      'Content-Type': 'application/json',
    },
    method: 'POST',
    body: JSON.stringify(params),
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
