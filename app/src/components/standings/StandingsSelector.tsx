import React, { useEffect, useState } from 'react';
import { useQuery } from '@tanstack/react-query';
import { getSeasonLeaderboards } from '../../services/standingsApi';
import Loading from '../../util/Loading';
import StandingsTemplate from './StandingsTemplate';
import { seasonStandingsResource } from '../../services/DTOs';
import Button from '../../util/Button';
import StandingsModal from './StandingsModal';

const StandingsSelector = () => {
  const [seasonNumber, setSeasonNumber] = useState(1);
  const [showSeasons, setShowSeasons] = useState(false);

  const toggleShowSeasons = () => {
    setShowSeasons(!showSeasons);
  };

  const {
    isLoading: standingsAreLoading,
    error: standingsError,
    data: standingsData,
    refetch,
  } = useQuery({
    queryKey: [`standings/season`],
    queryFn: () => getSeasonLeaderboards(seasonNumber),
    enabled: false,
  });

  useEffect(() => {
    refetch();
  }, []);

  if (standingsAreLoading) {
    return <Loading />;
  }

  if (standingsError) {
    return <div>ope, something went wrong</div>;
  }

  function compare(a: seasonStandingsResource, b: seasonStandingsResource) {
    if (a.seasonTotal < b.seasonTotal) {
      return 1;
    } else if (a.seasonTotal > b.seasonTotal) {
      return -1;
    }
    return 0;
  }

  if (standingsData) {
    const standings = standingsData.sort(compare);
    return (
      <>
        <div className="flex h-16 flex-row justify-evenly bg-dgbackground text-dgsoftwhite">
          <Button
            label={'Select Season'}
            onClick={toggleShowSeasons}
            disable={false}
          ></Button>
        </div>
        {showSeasons ? <StandingsModal toggleModal={toggleShowSeasons} /> : ''}
        <StandingsTemplate standings={standings} />;
      </>
    );
  }

  return <div>error</div>;
};

export default StandingsSelector;
