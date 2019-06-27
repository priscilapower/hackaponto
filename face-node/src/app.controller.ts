import { Controller, Res, HttpStatus, Post, Body } from '@nestjs/common';
import { FaceService } from './face/face.service';
import { Response } from 'express';
var base64Img = require('base64-img');

@Controller()
export class AppController {
  constructor(
    private readonly faceService: FaceService
  ) {

    faceService.run();

  }

  @Post('/similarity')
  async faceSimilarity(@Res() res: Response, @Body() values: any) {
    await this.faceService.create(values.current, values.original);

    console.log('similarity');

    let result = await this.faceService.faceSimilarity();
    result
      ? res.status(HttpStatus.OK).send()
      : res.status(HttpStatus.NOT_FOUND).send();
  }

  @Post('/expressions')
  async faceExpressions(@Res() res: Response, @Body() values: any) {
    await this.faceService.create(values.current);

    console.log('expressions');

    let result = await this.faceService.faceExpressions();
    res.status(HttpStatus.OK).json({ id: result });
  }

}
