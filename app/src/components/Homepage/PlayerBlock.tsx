const PlayerBlock = () => {
  return (
    <div className="container bg-dgsecondary p-2 text-dgsoftwhite">
      <div className="container flex justify-center">Paul McBeth</div>
      <div className="flex justify-evenly">
        <div className="flex flex-col">
          <div>Putt: 10</div>
          <div>scramble: 10</div>
        </div>
        <div className="flex flex-col">
          <div>Throw Pwr: 10</div>
          <div>Throw Acc: 10</div>
        </div>
      </div>
      <div></div>
    </div>
  );
};

export default PlayerBlock;
