import { Module } from '@nestjs/common';
import { AppController } from './app.controller';
import { FaceService } from './face/face.service';

@Module({
  imports: [],
  controllers: [AppController],
  providers: [FaceService],
})
export class AppModule {}
